const citySelect = document.getElementById('city');
const nurserySelect = document.getElementById('nursery');
const nurseryOptionsDiv = document.getElementById('nursery-options');
const form = document.getElementById('nursery-form');

// Dummy nursery data for each city
const nurseries = {
  'new-york': ['ramakrishna nursery', 'deepu nursery'],
  'los-angeles': ['green grass growers', 'West Coast Gardens']
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
      option.value = nursery.toLowerCase().replace(/ /g, '-'); // Generate value as kebab-case
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

// Handle form submission
form.addEventListener('submit', (event) => {
  event.preventDefault(); // Prevent default form submission

  const selectedNurseryValue = nurserySelect.value;

  if (!selectedNurseryValue) {
    alert('Please select a nursery.');
    return;
  }

  // Redirect to the specific nursery's HTML page
  window.location.href = `${selectedNurseryValue}.html`;
});
