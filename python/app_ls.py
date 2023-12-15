import os
import subprocess

current_directory = os.getcwd()
folder_name = "fabric"
folder_path = os.path.join(current_directory, folder_name)

if os.path.isdir(folder_path):
    print("path OK")
    files = os.listdir(folder_path)

    for file in files:
        print(file)
        with open('dockerfile', 'r') as fichier:
            lignes = fichier.readlines()
            nouvelle_ligne = "COPY " + "fabric/" + file + " /server.jar\n"
            lignes[15] = nouvelle_ligne
            with open('dockerfile', 'w') as fichier:
                fichier.writelines(lignes)
        print("dockerfile OK")

        version = file.split("mc.")[1].split("-")[0]
        command = "docker build -t thorbeorndev/minecraftserver:fabric-" + version + " ."
        process = subprocess.Popen(command, shell=True, stdout=subprocess.PIPE, stderr=subprocess.PIPE)
        stdout, stderr = process.communicate()
        if stderr:
            print(f"Error: {stderr.decode('utf-8')}")
        else:
            print(f"Output:\n{stdout.decode('utf-8')}")
        print("build images " + version)
else:
    print(f"The specified folder '{folder_name}' does not exist in the current directory.")