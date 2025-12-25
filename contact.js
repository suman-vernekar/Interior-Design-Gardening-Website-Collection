const citySelect = document.getElementById('city');
const nurserySelect = document.getElementById('nursery');
const nurseryOptionsDiv = document.getElementById('nursery-options');

// Dummy nursery data for each city
const nurseries = {
  'new-york': ['Central Park Nursery', 'Green Thumb Gardens', 'Urban Oasis'],
  'los-angeles': ['Sunny Blooms Nursery', 'West Coast Gardens', 'Plant Haven'],
  'chicago': ['Windy City Nursery', 'Lakeside Gardens', 'Midwest Blooms']
};

// Event listener for city selection
citySelect.addEventListener('change', (event) => {
  const selectedCity = event.target.value;
  
  // Clear previous nursery options
  nurserySelect.innerHTML = '<option value="" disabled selected>Select a nursery</option>';

  if (selectedCity && nurseries[selectedCity]) {
    // Populate nursery options
    nurseries[selectedCity].forEach((nursery) => {
      const option = document.createElement('option');
      option.value = nursery.toLowerCase().replace(/ /g, '-');
      option.textContent = nursery;
      nurserySelect.appendChild(option);
    });

    // Show nursery options
    nurseryOptionsDiv.classList.remove('hidden');
  } else {
    // Hide nursery options if no city is selected
    nurseryOptionsDiv.classList.add('hidden');
  }
});
