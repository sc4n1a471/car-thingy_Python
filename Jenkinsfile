def dockerImage
def version
def buildNumber
def branchName

pipeline {
    agent any
    environment {
        DOCKER_REGISTRY = 'sc4n1a471'

        CAR_THINGY_PYTHON_USERNAME = credentials('CAR-THINGY_PYTHON_USERNAME')
        CAR_THINGY_PYTHON_PASSWORD = credentials('CAR-THINGY_PYTHON_PASSWORD')
        CAR_THINGY_PYTHON_GRID_IP = credentials('CAR-THINGY_PYTHON_GRID_IP')
        CAR_THINGY_PYTHON_GO_IP_PROD = credentials('CAR-THINGY_PYTHON_GO_IP_PROD')
        CAR_THINGY_PYTHON_GO_IP_DEV = credentials('CAR-THINGY_PYTHON_GO_IP_DEV')
    }
    stages {
        stage('Checkout') {
            parallel {
                stage('Checkout the branch') {
                    when {
                        not {
                            changeRequest()
                        }
                    }
                    steps {
                        echo "Checking out ${env.BRANCH_NAME} branch..."
                        git branch: env.BRANCH_NAME, credentialsId: 'Home-VM_jenkins', url: 'git@github.com:sc4n1a471/car-thingy_Python.git'
                    }
                }
            }
        }

        // MARK: Read Version
        stage('Read Version') {
            when {
                not {
                    changeRequest()
                }
            }
            steps {
                script {
                    version = readFile('version').trim()
                    echo "Building version ${version}"

                    buildNumber = env.BUILD_NUMBER
                    echo "Build number: ${buildNumber}"

                    branchName = env.BRANCH_NAME
                    echo "Build branch: ${branchName}"
                }
            }
        }

        stage('Build and Push') {
            parallel {
                stage('Push production docker image') {
                    when {
                        branch 'main'
                    }
                    steps {
                        script {
                            dockerImage = docker.build("sc4n1a471/car-thingy_python:${version}-${buildNumber}")
                            docker.withRegistry('https://registry.hub.docker.com', 'DOCKER_HUB') {
                                dockerImage.push("latest")
                                dockerImage.push("${version}-${buildNumber}")
                            }
                        }
                    }
                }

                stage('Push not production docker image') {
                    when {
                        not {
                            changeRequest()
                        }
                        not {
                            branch 'main'
                        }
                    }
                    steps {
                        script {
                            dockerImage = docker.build("sc4n1a471/car-thingy_python:${version}-${branchName}-${buildNumber}")
                            docker.withRegistry('https://registry.hub.docker.com', 'DOCKER_HUB') {
                                dockerImage.push("latest-${branchName}")
                                dockerImage.push("${version}-${branchName}-${buildNumber}")
                            }
                        }
                    }
                }
            }
        }

        stage('Deploy development') {
            when {
                not {
                    changeRequest()
                }
                not {
                    branch 'main'
                }
            }

            steps {
                script {
                    echo "Deploying version ${version}, build ${buildNumber} to ${branchName} branch"

                    sh """
                    if [ \$(docker ps -a -q -f name=car-thingy_python_$branchName) ]; then
                        docker rm -f car-thingy_python_$branchName
                        echo "Container removed"
                    fi
                        
                    if [ \$(docker images -q sc4n1a471/car-thingy_python:$version-$branchName-$buildNumber) ]; then
                        docker rmi -f sc4n1a471/car-thingy_python:$version-$branchName-$buildNumber
                        echo "Image removed"
                    fi
                    """

                    sh """
                    terraform init

                    terraform apply \
                        -var="container_name=car-thingy_python_$branchName" \
                        -var="container_version=$version-$branchName-$buildNumber" \
                        -var="env=$branchName" \
                        -var="run_on_server=true" \
                        -var="app_username=\$CAR_THINGY_PYTHON_USERNAME" \
                        -var="app_password=\$CAR_THINGY_PYTHON_PASSWORD" \
                        -var="app_grid_ip=\$CAR_THINGY_PYTHON_GRID_IP" \
                        -var="go_ip=\$CAR_THINGY_PYTHON_GO_IP_DEV" \
                        -auto-approve
                    """
                }
            }
        }
        stage('Deploy production') {
            when {
                branch 'main'
            }

            steps {
                script {
                    echo "Deploying version ${version}, build ${buildNumber} to PROD"

                    sh """
                    if [ \$(docker ps -a -q -f name=car-thingy_python) ]; then
                        docker rm -f car-thingy_python
                        echo "Container removed"
                    fi

                    if [ \$(docker images -q sc4n1a471/car-thingy_python:$version-$buildNumber) ]; then
                        docker rmi -f sc4n1a471/car-thingy_python:$version-$buildNumber
                        echo "Image removed"
                    fi
                    """

                    sh """
                    terraform init

                    terraform apply \
                        -var="container_name=car-thingy_python" \
                        -var="container_version=$version-$buildNumber" \
                        -var="env=prod" \
                        -var="run_on_server=true" \
                        -var="app_username=\$CAR_THINGY_PYTHON_USERNAME" \
                        -var="app_password=\$CAR_THINGY_PYTHON_PASSWORD" \
                        -var="app_grid_ip=\$CAR_THINGY_PYTHON_GRID_IP" \
                        -var="go_ip=\$CAR_THINGY_PYTHON_GO_IP_PROD" \
                        -auto-approve
                    """
                }
            }
        }
        stage('Cleanup after merge') {
            when {
                anyOf {
                    changeRequest target: 'dev'
                }
            }
            steps {
                script {
                    echo "Cleaning up Docker images and containers for to be merged branch ${env.CHANGE_BRANCH}"

                    sh """
                    if [ \$(docker ps -a -q -f name=car-thingy_python_${env.CHANGE_BRANCH}) ]; then
                        docker rm -f car-thingy_python_${env.CHANGE_BRANCH}
                        echo "Container removed"
                    fi

                    if [ \$(docker images -q sc4n1a471/car-thingy_python:${version}-${env.CHANGE_BRANCH}-${buildNumber}) ]; then
                        docker rmi -f sc4n1a471/car-thingy_python:${version}-${env.CHANGE_BRANCH}-${buildNumber}
                        echo "Image removed"
                    fi
                    """
                }
            }
        }
        stage('Remove prev docker image') {
            when {
                not {
                    changeRequest()
                }
            }
            script {
                def previousBuildNumber = buildNumber.toInteger() - 1
                if (previousBuildNumber > 0) {
                    echo "Removing previous build number associated Docker image: ${version}-${branchName}-${previousBuildNumber}"
                    sh "docker rmi -f sc4n1a471/car-thingy_python:${version}-${branchName}-${previousBuildNumber}"
                }
            }
        }
    }
    post {
        success {
            echo 'Build and deployment successful!'
        }
        failure {
            echo 'Build or deployment failed.'
        }
        always {
            cleanWs()
            echo "Cleaning docker images"
            sh "docker rmi -f sc4n1a471/car-thingy_python"
            sh "docker image prune -f"
        }
    }
}