<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="dashboard.css">
        <title>MCServerManager | dashboard</title>
    </head>
    <body>
        <div class="app">
            <div class="dashboard-indicateur">
                <div class="indicateur-item">
                    <div class="indicateur-gauge"><div class="indicateur-gauge-back"><div class="indicateur-gauge-front red"><div><img class="fit-picture" src="cpu.png" alt="CPU"><p class="pourcent">20 %</p></div><svg><circle style="stroke-dasharray:calc(var(--dasharray-max) * 20 / 100), var(--dasharray-max);" class="red" fill="white" r="30%" cx="50%" cy="50%"/></svg></div></div><p class="indicateur-gauge-label">Consomation CPU</p></div>
                    <div class="indicateur-gauge"><div class="indicateur-gauge-back"><div class="indicateur-gauge-front blue"><div><img class="fit-picture" src="cpu.png" alt="CPU"><p class="pourcent">40 %</p></div><svg><circle style="stroke-dasharray:calc(var(--dasharray-max) * 40 / 100), var(--dasharray-max);" class="blue" fill="white" r="30%" cx="50%" cy="50%"/></svg></div></div><p class="indicateur-gauge-label">Consomation RAM</p><p class="indicateur-gauge-label2">3,6 Go / 16 Go</p></div>
                    <div class="indicateur-gauge"><div class="indicateur-gauge-back"><div class="indicateur-gauge-front pink"><div><img class="fit-picture" src="cpu.png" alt="CPU"><p class="pourcent">60 %</p></div><svg><circle style="stroke-dasharray:calc(var(--dasharray-max) * 40 / 100), var(--dasharray-max);" class="pink" fill="white" r="30%" cx="50%" cy="50%"/></svg></div></div><p class="indicateur-gauge-label">Nombre de joueurs</p><p class="indicateur-gauge-label2">0 / 25</p></div>
                    <div class="indicateur-gauge"><div class="indicateur-gauge-back"><div class="indicateur-gauge-front lime"><div><img class="fit-picture" src="cpu.png" alt="CPU"><p class="pourcent">80 %</p></div><svg><circle style="stroke-dasharray:calc(var(--dasharray-max) * 40 / 100), var(--dasharray-max);" class="lime" fill="white" r="30%" cx="50%" cy="50%"/></svg></div></div><p class="indicateur-gauge-label">Nombre de Plugins</p></div>
                    <div class="indicateur-gauge"><div class="indicateur-gauge-back"><div class="indicateur-gauge-front gold"><div><img class="fit-picture" src="cpu.png" alt="CPU"><p class="pourcent">0 %</p></div><svg><circle style="stroke-dasharray:calc(var(--dasharray-max) * 40 / 100), var(--dasharray-max);" class="gold" fill="white" r="30%" cx="50%" cy="50%"/></svg></div></div><p class="indicateur-gauge-label">Nombre de Bannis</p><p class="indicateur-gauge-label2">0 Joueurs / 0 IPs</p></div>
                </div>
            </div>
        </div>
    </body>
</html>
