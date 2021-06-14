#!/bin/bash
export SONAR_TOKEN="4a7163dc87ff00ae25f37ce6c1171779a5e18717"
echo $SONAR_TOKEN

sonar-scanner -Dsonar.organization=drosanda -Dsonar.projectKey=drosanda_apptanya -Dsonar.sources=. -Dsonar.host.url=https://sonarcloud.io
