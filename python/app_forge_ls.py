import os
import subprocess

current_directory = os.getcwd()

installer_folder_name = "forge"
installer_folder_path = os.path.join(current_directory, installer_folder_name)
server_folder_name = "forge_folder"
server_folder_path = os.path.join(current_directory, server_folder_name)

if os.path.isdir(installer_folder_path):
    print("installer_folder_path OK")
    if os.path.isdir(server_folder_path):
        print("server_folder_path OK\n================")
        files_temp = os.listdir(installer_folder_path)
        files = [file for file in files_temp if file.endswith(".jar")]
        for file in files :
            print(file)
            folder_name = server_folder_path + "/" + file.split(".jar")[0]
            if not os.path.exists(folder_name):
                os.makedirs(folder_name)
                print(f"Folder '{file.split('.jar')[0]}' OK")
                command = "java -Xms4G -Xmx4G -jar " + installer_folder_path + "/" + file + " --installServer " + folder_name + "/." 
                print(command)
                process = subprocess.Popen(command, shell=True, stdout=subprocess.PIPE, stderr=subprocess.PIPE)
                stdout, stderr = process.communicate()
                if not stderr:
                    print(file + " Server Install OK\n================")
                else:
                    print(f"Error: {stderr.decode('utf-8')}")
            version = file.split("-")[1]
            os.rename(current_directory + "/minecraftforge-universal-" + file.split("-")[1] + "-" + file.split("-")[2] + ".jar", server_folder_path + "/" + file.split(".jar")[0] + "/minecraftforge-universal-" + file.split("-")[1] + "-" + file.split("-")[2] + ".jar")
            os.rename(current_directory + "/minecraft_server." + version + ".jar", server_folder_path + "/" + file.split(".jar")[0] + "/minecraft_server." + version + ".jar")
            os.rename(current_directory + "/libraries", server_folder_path + "/" + file.split(".jar")[0] + "/libraries")
            with open('dockerfile', 'r') as fichier:
                lignes = fichier.readlines()
                nouvelle_ligne = "COPY " + server_folder_name + "/" + file.split(".jar")[0] + "/libraries /libraries\n"
                nouvelle_ligne_2 = "COPY " + server_folder_name + "/" + file.split(".jar")[0] + "/minecraftforge-universal-" + file.split("-")[1] + "-" + file.split("-")[2] + ".jar /forgeserver.jar\n"
                nouvelle_ligne_3 = "COPY " + server_folder_name + "/" + file.split(".jar")[0] + "/minecraft_server." + version + ".jar /minecraft_server." + version + ".jar\n"
                lignes[15] = nouvelle_ligne
                lignes[16] = nouvelle_ligne_2
                lignes[17] = nouvelle_ligne_3
                with open('dockerfile', 'w') as fichier:
                    fichier.writelines(lignes)
            print("dockerfile OK")
            command = "docker build -t thorbeorndev/minecraftserver:forge-" + version + " ."
            process = subprocess.Popen(command, shell=True, stdout=subprocess.PIPE, stderr=subprocess.PIPE)
            stdout, stderr = process.communicate()
            if not stderr:
                print("build images " + version + " OK\n================")
            else:
                print(f"Error: {stderr.decode('utf-8')}")
    else:
        print(f"The specified folder '{server_folder_name}' does not exist in the current directory.")
else:
    print(f"The specified folder '{installer_folder_name}' does not exist in the current directory.")