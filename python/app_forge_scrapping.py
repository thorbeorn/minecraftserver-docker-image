import requests
from bs4 import BeautifulSoup
import re
import os

def filter_index_href(tag):
    return tag.name == 'a' and tag.has_attr('href') and re.match(r'^index_1.', tag['href'])
def filter_title_installer(tag):
    return tag.name == 'a' and tag.has_attr('title') and tag['title'] == 'Installer'

current_directory = os.getcwd()
url = 'https://files.minecraftforge.net/net/minecraftforge/forge/'
response = requests.get(url)
document = BeautifulSoup(response.content, 'html.parser')

filtered_a = [link['href'] for link in document.find_all(filter_index_href)]
for pre_link in filtered_a :
    print('===========')
    print(pre_link)
    print('===========')
    forge_installer_url = url + pre_link
    forge_installer_response = requests.get(forge_installer_url)
    forge_installer_document = BeautifulSoup(forge_installer_response.content, 'html.parser')

    forge_installer_version = forge_installer_document.find_all("div", class_="download")
    if len(forge_installer_version) == 2 :
        filtered_links_temp = [link['href'] for link in forge_installer_version[1].find_all(filter_title_installer)]
        if len(filtered_links_temp) >= 1 :
            filtered_links = filtered_links_temp[0].split("&url=")[1]
            if not os.path.exists(current_directory + "/forge/" + filtered_links.split("/")[7]):
                response = requests.get(filtered_links)
                if response.status_code == 200:
                    with open("forge/" + filtered_links.split("/")[7], 'wb') as f:
                        f.write(response.content)
                    print("Téléchargement terminé!")
                else:
                    print("Échec du téléchargement. Code d'état :", response.status_code)
            else:
                print("File exist.")
        else:
            print("no installer")
    elif len(forge_installer_version) == 1:
        filtered_links_temp = [link['href'] for link in forge_installer_version[0].find_all(filter_title_installer)]
        if len(filtered_links_temp) >= 1 :
            filtered_links = filtered_links_temp[0].split("&url=")[1]
            if not os.path.exists(current_directory + "/forge/" + filtered_links.split("/")[7]):
                response = requests.get(filtered_links)
                if response.status_code == 200:
                    with open("forge/" + filtered_links.split("/")[7], 'wb') as f:
                        f.write(response.content)
                    print("Téléchargement terminé!")
                else:
                    print("Échec du téléchargement. Code d'état :", response.status_code)
            else:
                print("File exist.")
        else:
            print("no installer")