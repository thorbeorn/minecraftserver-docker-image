// Import de Chart.js et du plugin de zoom

import Chart from 'chart.js/auto';
import zoom from 'chartjs-plugin-zoom';

// Enregistrez le plugin de zoom
Chart.register(zoom);

// Récupérez l'élément canvas
const networkChartCanvas = document.getElementById('network-chart');

// Définissez les données du graphique de Network Usage
const networkChartData = {
  labels: [], // Ce tableau contiendra les étiquettes (par exemple, les heures)
  datasets: [
    {
      label: 'Débit émis',
      data: [], // Ce tableau contiendra les données pour le débit émis
      borderColor: 'rgba(75, 192, 192, 1)',
      fill: false
    },
    {
      label: 'Débit reçu',
      data: [], // Ce tableau contiendra les données pour le débit reçu
      borderColor: 'rgba(255, 99, 132, 1)',
      fill: false
    }
  ]
};

// Créez le graphique de Network Usage en utilisant Chart.js
const networkChart = new Chart(networkChartCanvas, {
  type: 'line',
  data: networkChartData,
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
    maintainAspectRatio: false,
    scales: {
      y: {
        beginAtZero: true,
        min: 0, // Définir le minimum de l'axe des y à 0
        max: 1000, // Définir le maximum de l'axe des y à 1000
        ticks: {
          // Formattez les valeurs affichées pour inclure ' Mb' après le nombre
          callback: function(value, index, values) {
            return value + ' Mb';
          }
        }
      }
    }
  }
});


// Exemple de mise à jour du graphique avec de nouvelles données
function updateNetworkChart(sentData, receivedData) {
  // Générer les labels correspondant à l'heure actuelle
  const currentTime = new Date();
  const label = currentTime.toLocaleTimeString();

  // Mettre à jour les données du graphique de Network Usage avec les nouvelles données fournies
  networkChart.data.labels.push(label);
  networkChart.data.datasets[0].data.push(sentData);
  networkChart.data.datasets[1].data.push(receivedData);

  // Si le tableau labels a plus de 60 éléments, supprimez le premier élément
  if (networkChart.data.labels.length > 60) {
    networkChart.data.labels.shift();
    networkChart.data.datasets[0].data.shift();
    networkChart.data.datasets[1].data.shift();
  }

  // Mettre à jour le graphique
  networkChart.update();
}

// Exemple d'utilisation : mettre à jour le graphique de Network Usage avec de nouvelles données
// Remplacez les valeurs des arguments sentData et receivedData par vos propres valeurs
updateNetworkChart(100, 200); // Exemple avec des valeurs de débit émis et reçu


export default function createNetworkChart() {
    // Exemple de mise à jour du graphique avec de nouvelles données toutes les 5 secondes
    setInterval(() => {
      const randomSentData = Math.random() * 1000;
      const randomReceivedData = Math.random() * 1000;
      updateNetworkChart(randomSentData, randomReceivedData);
    }, 5000);
}