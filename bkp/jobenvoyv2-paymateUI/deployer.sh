#!/bin/sh

project="Jobenvoy"
version_no=""
response=""
checkout_git=""
git_tags=""
lastest_ver=""

RED=$'\e[91m'
GREEN=$'\e[0;32m'
YELLOW=$'\e[93m'
NC=$'\e[0m'
LG=$'\e[92m'

Welcome () {
  echo
  echo "***Initiating $project deployment progress***"
  echo "//author: simfyz @ Red Beryl IT"
  echo
  echo "${YELLOW}Fetching remote repository..."
  echo "Updating latest commits and branches from remote repository...${NC}"
  git fetch
  if [ $? -eq 0 ]; then
	echo
  else
	read -p "${RED}Press Enter || Return key to exit"
    exit
  fi

  lastest_ver=`git describe --tags`
  echo
  #git_tags=$(git tag)
  # shellcheck disable=SC2154
  git_tags=`git tag --sort=taggerdate`

  Get_version_tag
}

Get_version_tag() {
  echo "Released versions tags available on the Git repository"
  echo "${GREEN}$git_tags${NC}"
  echo
  echo "Please enter the version number from above list to deploy (If you don't give a version number, just press enter it will pull the latest tagged version)"
  echo
  read -p "Enter the version tag : " version_no
}

Write_version_file() {
#  echo $version_no > version.txt
  write_ver=`echo $version_no > version.txt`
  echo $write_ver
}

Update_version () {
# Only proceed if version number has actually changed (i.e. a new tag has been created)
if [ ! $(cmp --silent version.tmp version.txt) ]
then
    NEWVER=$(cat version.txt)
    echo Updating build number $NEWVER
#    git tag -a $NEWVER -m ' '
    rm version.tmp
fi
}

Deploy_latest() {
  version_no=`git describe --tags`
  checkout_git=`git checkout $version_no`
  echo "$checkout_git"
  retVal=$?
  echo $retVal
  if [ $retVal -eq 0 ]; then
      echo "${LG}Successfully deployed tagged version $version_no${NC}"
      Write_version_file
      read -p "Press Enter || Return key to exit"
      exit
  else
    read -p "Press Enter || Return key to exit"
    Write_version_file
  fi
}

Deploy_selected() {
  checkout_git=`git checkout $version_no`
  echo "$checkout_git"
  retVal=$?
  echo $retVal
  if [ $retVal -eq 0 ]; then
      echo "${LG}Successfully deployed tagged version $version_no${NC}"
      Write_version_file
      read -p "Press Enter || Return key to exit"
      exit
  else
    read -p "Press Enter || Return key to exit"
    Write_version_file
  fi
}

Welcome

if [[ $version_no == 0 ]]; then
#  Get the latest version tag
  latestTag=$(git describe --tags `git rev-list --tags --max-count=1`)
  echo $lastestTag
   echo "You selected to deploy latest version. Current latest version is ${GREEN}$lastest_ver${NC}"
   echo "Please press Y to continue the process, N or return key to cancel it"
   read -p "(Y/N): " response
   if [[ $response =~ ^[Yy]$ ]]
   then
     Deploy_latest
   else
     Get_version_tag
   fi
else
#  get the selected version tag
   if [[ $git_tags =~ $version_no ]]; then
      echo "You have selected version tag ${GREEN}$version_no${NC}"
      echo "Please press Y to continue the process, N to cancel or return key to exit"
      read -p "(Y/N): " response
      if [[ $response =~ ^[Yy]$ ]]
      then
        Deploy_selected
      else
        Get_version_tag
   fi
   else
     echo
     echo "Your entered $version is not avaialable in the repository. Please choose one of the version in the list or hit enter to deploy the latest version"
     Get_version_tag
   fi
fi
