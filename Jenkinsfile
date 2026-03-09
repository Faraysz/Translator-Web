node {

 checkout scm

 stage("Build"){
  docker.image('composer:2').inside('-u root') {
   sh 'composer install'
  }
 }

 stage("Test"){
  docker.image('php:8.2-cli').inside('-u root') {
   sh 'php -v'
  }
}
