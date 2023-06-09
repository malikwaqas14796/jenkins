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
                    echo '<br><br>'
                    echo '---------------------------------Build Stage Starts here-----------------------------------------'
                    echo '<br>'
                    echo '---------------------------------Step 1 checking python version-----------------------------------------'
                    echo '<br>'
                    bat 'python --version'
                    echo '<br>'
                    echo '---------------------------------Step 2 running Unit test-----------------------------------------'
                    echo '<br>'
                    bat 'python unit-test.py'
                    echo '<br>'
                    echo '---------------------------------Build Stage Ends here here-----------------------------------------'
                }
            }
        }
        stage('Automated Testing Stage') {
            
                steps {
                    script {
                    echo '<br><br>'
                    echo '---------------------------------Testing Stage Starts here-----------------------------------------'
                    echo '<br>'
                    echo '---------------------------------Step 1 running QA case-----------------------------------------'
                    echo '<br>'
                    bat 'python test-case.py'
                    echo '<br>'
                    echo '---------------------------------Testing Stage Ends here here-----------------------------------------'
                    
                }
            }
        }

        stage('SonarQube Analysis') {
            steps
            {
                echo "Running on ${env.NODE_NAME}"
                script {
                withSonarQubeEnv(installationName: 'SonarQube') {
                // bat "C:/sonarqube-10.0.0.68432/bin/windows-x86-64/StartSonar.bat"
                }
            }
        }
    }

        stage('Deployment Stage') {
            steps {
                script {
                    echo '<br><br>'
                    echo '---------------------------------Deployment Stage Starts here-----------------------------------------'
                    echo '<br>'
                    bat 'ping 172.16.178.94'
                    echo '<br>'
                    echo '---------------------------------Deployment Stage Ends here here-----------------------------------------'
                }
            }
        }
    }

    post {
        success {
            script {
                echo '<br><br>'
                echo '---------------------------------Notification Success case starts here-----------------------------------------'
                emailext subject: 'Build Successful', 
                          body: '<strong>Dear Concerned</strong><br><br>Job executed successfully. Details are given below.<br><br><pre>'+'''$BUILD_LOG'''+'</pre><br><br>Regards<br><br><strong>Jenkins Support</strong>',
                          to: 'waqas.rafique@nayatel.com',
                          from: 'malikwaqas14796@gmail.com'

                echo '<br>'
                echo '---------------------------------Notification Success case ends here-----------------------------------------'
            }
        }

        failure {
            script {
                echo '<br><br>'
                echo '---------------------------------Notification Success case starts here-----------------------------------------'
                emailext subject: 'Build Unsuccessful', 
                          body: '<strong>Dear Concerned</strong><br><br>Job execution unsuccessful. Please go through below details and re-push changes after rectification.<br><br><pre>'+'''$BUILD_LOG'''+'</pre><br><br>Regards<br><br><strong>Jenkins Support</strong>',
                          to: 'waqas.rafique@nayatel.com',
                          from: 'malikwaqas14796@gmail.com'
                echo '<br>'
                echo '---------------------------------Notification Failure case ends here-----------------------------------------'
            }
        }
    }
}