import requests
from bs4 import BeautifulSoup
import subprocess

url = 'https://getbukkit.org/download/craftbukkit'
response = requests.get(url)
document = BeautifulSoup(response.content, 'html.parser')

downloads = document.find_all('div', class_='download-pane')
for download in downloads:
    btnVersion = download.find_all('div', class_='col-sm-3')[0].find('h2').text
    btnHref = download.find(id='downloadr').get('href')
    
    serverJarDownloadUrl = btnHref
    serverJarDownloadRequest = requests.get(serverJarDownloadUrl)
    serverJarDownloadDocument = BeautifulSoup(serverJarDownloadRequest.content, 'html.parser')
    serverJarDownloadLink = serverJarDownloadDocument.find('div', class_='well').find_all('a')[0].get('href')
    print("link scrapped")

    with open('dockerfile', 'r') as fichier:
        lignes = fichier.readlines()

        nouvelle_ligne = "ADD " + serverJarDownloadLink + " /server.jar\n"
        lignes[15] = nouvelle_ligne

        with open('dockerfile', 'w') as fichier:
            fichier.writelines(lignes)
    print("dockerfil link changed")

    command = "docker build -t thorbeorndev/minecraftserver:craftbukkit-" + btnVersion + " ."
    process = subprocess.Popen(command, shell=True, stdout=subprocess.PIPE, stderr=subprocess.PIPE)
    stdout, stderr = process.communicate()
    if stderr:
        print(f"Error: {stderr.decode('utf-8')}")
    else:
        print(f"Output:\n{stdout.decode('utf-8')}")
    print("build images " + btnVersion)