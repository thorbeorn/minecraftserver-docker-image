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
    scales: {
      y: {
        beginAtZero: true
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

  // Mettre à jour le graphique
  networkChart.update();
}

// Exemple d'utilisation : mettre à jour le graphique de Network Usage avec de nouvelles données
// Remplacez les valeurs des arguments sentData et receivedData par vos propres valeurs
updateNetworkChart(100, 200); // Exemple avec des valeurs de débit émis et reçu

// Exemple de mise à jour du graphique avec de nouvelles données toutes les 5 secondes
setInterval(() => {
  const randomSentData = Math.random() * 100;
  const randomReceivedData = Math.random() * 100;
  updateNetworkChart(randomSentData, randomReceivedData);
}, 5000);
