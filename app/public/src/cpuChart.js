// Import de Chart.js et du plugin de zoom

import Chart from 'chart.js/auto';
import zoom from 'chartjs-plugin-zoom';

// Enregistrez le plugin de zoom
Chart.register(zoom);

// Obtenez la référence vers le canvas
const cpuPerformanceChartCanvas = document.getElementById('cpu-performance-chart');

// Définissez les données du graphique
const cpuPerformanceData = {
  labels: [], // Les étiquettes des points (les moments où les données ont été enregistrées)
  datasets: [
    {
      label: 'Utilisation du CPU',
      data: [], // Les valeurs d'utilisation du CPU (en pourcentage)
      backgroundColor: 'rgba(76, 175, 80, 0.2)',
      borderColor: 'rgba(76, 175, 80, 1)',
      borderWidth: 3, // L'épaisseur de la ligne du graphique
    },
  ],
};

// Initialisez le graphique
const cpuPerformanceChart = new Chart(cpuPerformanceChartCanvas, {
  type: 'line', // Type de graphique (courbes dans cet exemple)
  data: cpuPerformanceData,
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
    responsive: true,
    scales: {
      y: {
        beginAtZero: true,
        max: 100,
      },
    },
    elements: {
      line: {
        fill: 'start', // Remplissage de la courbe
        backgroundColor: 'rgba(76, 175, 80, 0.2)', // Couleur de remplissage
        borderColor: 'rgba(76, 175, 80, 1)', // Couleur de la ligne
        borderWidth: 1,
      },
    },
  },
  
});

// Fonction pour mettre à jour les données du graphique
function updateCpuPerformanceChart(timestamp, cpuUsage) {
  cpuPerformanceChart.data.labels.push(timestamp);
  cpuPerformanceChart.data.datasets[0].data.push(cpuUsage);

  // Limitez le nombre de points affichés à une certaine quantité (par exemple, 60 points pour 1 minute)
  const maxDataPoints = 60;
  if (cpuPerformanceChart.data.labels.length > maxDataPoints) {
    cpuPerformanceChart.data.labels.shift();
    cpuPerformanceChart.data.datasets[0].data.shift();
  }

  cpuPerformanceChart.update();
}


export default function createCpuChart() {
    // Fonction pour mettre à jour les données du graphique
    setInterval(() => {
        const timestamp = new Date().toLocaleTimeString();
        const cpuUsage = Math.random() * 100; // Valeur aléatoire entre 0 et 100
        updateCpuPerformanceChart(timestamp, cpuUsage);
    }, 1000);
}
