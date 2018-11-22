#!/usr/bin/env groovy

pipeline {
  agent any
  stages {
    stage('Static checks') {
      parallel {
        stage('PHPCS') {
          steps {
            echo 'Running PHPCS'
            sh('phpcs . --report=checkstyle | tee phpcs.xml && [ ${PIPESTATUS[0]} -eq 0 ]')
          }
        }
        stage('PHPMD') {
          steps {
            echo 'Running PHPMD'
            sh('php phpmd/phpmd.phar . xml phpmd/ruleset.xml | tee phpmd.xml && [ ${PIPESTATUS[0]} -eq 0 ]')
          }
        }
      }
    }
    stage('Build & Deploy') {
      steps {
        echo 'Building sources'
        sleep 30
        echo 'Deploying to test environment'
        sleep 30
      }
    }
    stage('QA') {
      parallel {
        stage('Acceptance tests') {
          steps {
            echo 'Running Behat'
            sleep 30
          }
        }
        stage('Backend Performance') {
          steps {
            echo 'Running Blackfire'
            sleep 30
          }
        }
        stage('Frontend Performance') {
          steps {
            echo 'Running Lighthouse'
            sleep 30
          }
        }
        stage('Visual Regression Testing') {
          steps {
            echo 'Running image comparison'
            sleep 30
          }
        }
      }
    }
  }

  post {
    failure {
      ViolationsToGitHub([
        commentOnlyChangedContent: true,
        commentTemplate: '',
        createSingleFileComments: true,
        credentialsId: 'github',
        gitHubUrl: 'https://api.github.com/',
        pullRequestId: env.CHANGE_ID,
        repositoryName: 'jenkins-test',
        repositoryOwner: 'fariasf',
        violationConfigs: [
          [parser: 'CHECKSTYLE', pattern: '.*/phpcs.xml', reporter: 'Checkstyle'],
          [parser: 'PMD', pattern: '.*/phpmd.xml', reporter: 'PMD']
        ]
       ])
    }
  }
}
