/**
@author: Muhammad Waqas
@description: CI/CD pipeline
*/

pipeline {
    agent any

    stages {
        stage('Build Stage') {
            
                steps {
                    script {
                    bat 'python --version'
                    bat 'python unit-test.py'
                }
            }
        }
        stage('Automated Testing Stage') {
            
                steps {
                    script {
                    // bat 'python hello-world.py'
                    bat 'python test-case.py'
                    
                }
            }
        }
        stage('Deployment Stage') {
            steps {
                bat 'ping 172.16.178.94'
            }
        }
    }

    post {
        success {
            script {
                
                emailext subject: 'Build Successful', 
                          body: '<strong>Dear Concerned</strong><br><br>Job executed successfully. Details are given below.<br><br>'+errorMessage+'<br><br>Regards<br><br><strong>Jenkins Support</strong>',
                          to: 'waqas.rafique@nayatel.com',
                          from: 'malikwaqas14796@gmail.com'
            }
        }

        failure {
            script {
                emailext subject: 'Build Unsuccessful', 
                          body: '<strong>Dear Concerned</strong><br><br>Job execution unsuccessful. Please go through below details and re-push changes after rectification.<br><br>'+errorMessage+'<br><br>Regards<br><br><strong>Jenkins Support</strong>',
                          to: 'waqas.rafique@nayatel.com',
                          from: 'malikwaqas14796@gmail.com'
            }
        }
    }
}