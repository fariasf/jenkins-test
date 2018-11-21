pipeline {
  agent any
  stages {
    stage('Static checks') {
      parallel {
        stage('Coding Standards') {
          steps {
            echo 'Running PHPCS'
          }
        }
        stage('Code Quality') {
          steps {
            echo 'Running PHPMD'
          }
        }
      }
    }
    stage('Build') {
      steps {
        echo 'Building sources'
      }
    }
    stage('Deploy to test') {
      steps {
        echo 'Deploying to test environment'
      }
    }
    stage('QA') {
      parallel {
        stage('Acceptance tests') {
          steps {
            sh 'echo "Running Behat"'
          }
        }
        stage('Backend Performance') {
          steps {
            sh 'echo "Running Blackfire"'
          }
        }
        stage('Frontend Performance') {
          steps {
            echo 'Running Lighthouse'
          }
        }
        stage('Visual Regression Testing') {
          steps {
            echo 'Running image comparison'
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
}