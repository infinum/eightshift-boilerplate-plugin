#!/usr/bin/env sh

# Prettyfiers
BLUE='\033[0;36m'
RED='\033[0;31m'
BBLUE="\033[1;36m"
NC='\033[0m' # No Color

# Convert string to lowercase
function strtolower() {
  [ $# -eq 1 ] || return 1;
  local _str _cu _cl _x;
  _cu=(A B C D E F G H I J K L M N O P Q R S T U V W X Y Z);
  _cl=(a b c d e f g h i j k l m n o p q r s t u v w x y z);
  _str=$1;
  for ((_x=0;_x<${#_cl[*]};_x++)); do
    _str=${_str//${_cu[$_x]}/${_cl[$_x]}};
  done;
  echo $_str;
  return 0;
}

# Find and replace strings in files
function findReplace() {
  local var=$1
  local val=$2

  find . -type f -not -name '_rename.sh' -not -path '*/.git/*' | xargs -n1 sed -i.sedbak "s/$var/$val/g"
  find . -type f -name '*.sedbak' | xargs -n1 rm
}

echo "This script will rename your plugin and its contents. It will setup you project. \n"

echo "${BBLUE}Please enter your plugin name:${NC}"
echo "(This is the name that will be showed in the WordPress admin as the plugin name.)"
read init_plugin_real_name

if [[ -z "$init_plugin_real_name" ]]; then
  echo "${RED}Plugin name field is required ${NC}"
  exit 1
fi

echo "\n${BBLUE}Please enter your package name:${NC}"
echo "(This is the name that will be used for translations in all @package fields and the name of your plugin folder.)"
echo "(Must be lowercase with no special characters and no spaces. You can use '_' or '-' for spaces)"
read init_package_name

if [[ -z "$init_package_name" ]]; then
  echo "${RED}Package name field is required ${NC}"
  exit 1
fi

init_package_name="${init_package_name// /-}"
init_package_name=$(strtolower $init_package_name)


echo "\n${BBLUE}Please enter your plugin description:${NC}"
read init_description

echo "\n${BBLUE}Please enter author name:${NC}"
read init_author_name

echo "\n${BBLUE}Please enter author email:${NC}"
read init_author_email

echo "\n----------------------------------------------------\n"

echo "${BBLUE}Your details will be:${NC}\n"
echo "Plugin Name: ${BBLUE}$init_plugin_real_name${NC}"
echo "Description: ${BBLUE}$init_description${NC}"
echo "Author: ${BBLUE}$init_author_name${NC} <${BBLUE}$init_author_email${NC}>"
echo "Text Domain: ${BBLUE}$init_package_name${NC}"
echo "Package: ${BBLUE}$init_package_name${NC}"

echo "\n${RED}Confirm? (y/n)${NC}"
read confirmation

if [ "$confirmation" == "y" ]; then

  # Replace strings
  findReplace "init_plugin_real_name" "$init_plugin_real_name"
  findReplace "init_description" "$init_description"
  findReplace "init_author_name" "$init_author_name <$init_author_email>"
  findReplace "init_plugin_name" "$init_package_name"

  # Change folder name and main file.
  if [ "$init_package_name" != "init_plugin_name" ]; then
    mv "./init_plugin_name" "./$init_package_name"
    mv "./$init_package_name/init_plugin_name.php" "./$init_package_name/$init_package_name.php"
  fi

  echo "${BBLUE}Finished! Success! Now move the plugin to your WordPress project.${NC}"

else
  echo "\n${RED}Cancelled.${NC}"
fi
