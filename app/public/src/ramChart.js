// Import de Chart.js et du plugin de zoom

import Chart from 'chart.js/auto';
import zoom from 'chartjs-plugin-zoom';

// Enregistrez le plugin de zoom
Chart.register(zoom);

// Sélectionner l'élément canvas du graphique de la RAM
const ramPerformanceChartCanvas = document.getElementById('ram-performance-chart');

// Définir les données du graphique de la RAM
const ramPerformanceData = {
    labels: [], // Labels des points de données (peut être vide ou adapté à vos besoins)
    datasets: [
        {
            label: 'Utilisation de la RAM', // Nom de la courbe
            data: [], // Données d'utilisation de la RAM (peut être vide ou adapté à vos besoins)
            backgroundColor: 'rgba(76, 175, 80, 0.2)', // Couleur de remplissage de la courbe (vert avec transparence)
            borderColor: 'rgba(76, 175, 80, 1)', // Couleur de la ligne de la courbe (vert)
            borderWidth: 1, // Épaisseur de la ligne de la courbe
            fill: 'start' // Remplir la courbe avec la couleur de fond définie
        }
    ]
};

// Créer le graphique de la RAM en utilisant Chart.js
const ramPerformanceChart = new Chart(ramPerformanceChartCanvas, {
    type: 'line', // Type de graphique : ligne
    data: ramPerformanceData, // Utiliser les données définies précédemment
    options: {
        plugins: {
            zoom: {
                pan: {
                    enabled: true,
                    mode: 'xy'
                },
                zoom: {
                    wheel: {
                        enabled: true,
                    },
                    drag: {
                        enabled: true,
                    },
                    pinch: {
                        enabled: true,
                    },
                    mode: 'xy'
                }
            }
        },
        responsive: true, // Rendre le graphique réactif pour s'adapter à la taille de l'élément contenant
        scales: {
            y: {
                beginAtZero: true, // Débuter l'axe Y à zéro
                max: 100 // Valeur maximale de l'axe Y (100%)
            }
        },
        elements: {
            line: {
                tension: 0.3 // Contrôler la courbure de la ligne de la courbe
            }
        }
    }
});

// Exemple de mise à jour du graphique avec de nouvelles données
function updateRamPerformanceChart(newData) {
    // Générer les labels correspondant à l'heure actuelle pour chaque point de données
    const currentTime = new Date();
    const labels = newData.map(() => currentTime.toLocaleTimeString());

    // Mettre à jour les données du graphique de la RAM avec les nouvelles données fournies
    ramPerformanceChart.data.labels = labels;
    ramPerformanceChart.data.datasets[0].data = newData;

    // Mettre à jour le graphique
    ramPerformanceChart.update();
}

export default function createRamChart() {
    // Exemple d'utilisation : mettre à jour le graphique de la RAM avec de nouvelles données toutes les 5 secondes
    setInterval(() => {
        const randomData = [Math.random() * 100, Math.random() * 100, Math.random() * 100, Math.random() * 100];
        updateRamPerformanceChart(randomData);
    }, 5000);
}

