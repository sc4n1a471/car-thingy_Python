def dockerImage
def version
def buildNumber

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
                stage('Checkout main') {
                    when {
                        branch 'main'
                    }
                    steps {
                        git branch: 'main', credentialsId: 'Home-VM_jenkins', url: 'git@github.com:sc4n1a471/car-thingy_Python.git'
                    }
                }

                stage('Checkout dev') {
                    when {
                        branch 'dev'
                    }
                    steps {
                        git branch: 'dev', credentialsId: 'Home-VM_jenkins', url: 'git@github.com:sc4n1a471/car-thingy_Python.git'
                    }
                }
            }
        }

        // MARK: Read Version
        stage('Read Version') {
            when {
                anyOf {
                    branch 'main'
                    branch 'dev'
                }
            }
            steps {
                script {
                    version = readFile('version').trim()
                    echo "Building version ${version}"

                    buildNumber = env.BUILD_NUMBER
                    echo "Build number: ${buildNumber}"
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
                            dockerImage = docker.build("sc4n1a471/car-thingy_python:${version}-dev-${buildNumber}")
                            docker.withRegistry('https://registry.hub.docker.com', 'DOCKER_HUB') {
                                dockerImage.push("latest")
                                dockerImage.push("${version}-${buildNumber}")
                            }
                        }
                    }
                }

                stage('Push development docker image') {
                    when {
                        branch 'dev'
                    }
                    steps {
                        script {
                            dockerImage = docker.build("sc4n1a471/car-thingy_python:${version}-dev-${buildNumber}")
                            docker.withRegistry('https://registry.hub.docker.com', 'DOCKER_HUB') {
                                dockerImage.push("latest-dev")
                                dockerImage.push("${version}-dev-${buildNumber}")
                            }
                        }
                    }
                }
            }
        }

        stage('Deploy development') {
            when {
                branch 'dev'
            }

            steps {
                script {
                    echo "Deploying version ${version}, build ${buildNumber} to DEV"

                    sh """
                    if [ \$(docker ps -a -q -f name=car-thingy_python_dev) ]; then
                        docker rm -f car-thingy_python_dev
                        echo "Container removed"
                    fi
                        
                    if [ \$(docker images -q sc4n1a471/car-thingy_python:\$version-dev-\$buildNumber) ]; then
                        docker rmi -f sc4n1a471/car-thingy_python:\$version-dev-\$buildNumber
                        echo "Image removed"
                    fi
                    """

                    sh """
                    terraform init

                    terraform apply \
                        -var="container_version=$version-dev-$buildNumber" \
                        -var="env=dev" \
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

                    if [ \$(docker images -q sc4n1a471/car-thingy_python:\$version-\$buildNumber) ]; then
                        docker rmi -f sc4n1a471/car-thingy_python:\$version-\$buildNumber
                        echo "Image removed"
                    fi
                    """

                    sh """
                    terraform init

                    terraform apply \
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
    }
    post {
        success {
            echo 'Build and deployment successful!'
        }
        failure {
            echo 'Build or deployment failed.'
        }
    }
}