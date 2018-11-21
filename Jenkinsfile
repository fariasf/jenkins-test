pipeline {
  agent any
  stages {
    stage('Static checks') {
      parallel {
        stage('Coding Standards') {
          steps {
            echo 'Running PHPCS'
            sh('mkdir -p build/reports/checkstyle')
            sh('phpcs . --report=checkstyle > build/reports/checkstyle/phpcs.xml')
          }
        }
        stage('Code Quality') {
          steps {
            echo 'Running PHPMD'
            sleep 10
          }
        }
      }
    }
    stage('Build') {
      steps {
        echo 'Building sources'
        sleep 30
      }
    }
    stage('Deploy to test') {
      steps {
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
    stage('PO') {
      steps {
        input 'Does this look good?'
      }
    }
    stage('Deploy to staging') {
      steps {
        echo 'Deploying to staging'
        sleep 30
      }
    }
    stage('Smoke test') {
      steps {
        input 'Ready to go live?'
      }
    }
    stage('Deploy to production') {
      steps {
        echo 'Deploying to production'
      }
    }
  }

  post {
    failure {
      ViolationsToGitHub([commentOnlyChangedContent: true, commentTemplate: '', createSingleFileComments: true, credentialsId: 'github', gitHubUrl: 'https://api.github.com/', oAuth2Token: '', pullRequestId: env.CHANGE_ID, repositoryName: 'jenkins-test', repositoryOwner: 'fariasf', violationConfigs: [[parser: 'CHECKSTYLE', pattern: './build/reports/checkstyle/*.xml', reporter: 'Checkstyle']]])
    }
  }
}
