function navigate(section) {
    document.getElementById('main-content').innerHTML = `<h2>${section} Page</h2><p>Details for ${section} will appear here.</p>`;
}

function logout() {
    alert('Logged out successfully.');
    window.location.href = 'login.php';
}
fetch('add_patient.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(patientData),
})
    .then(response => response.json())
    .then(data => {
        if (data.message) {
            alert(data.message);
            document.getElementById('addPatientForm').reset();
        } else {
            alert(data.error);
        }
    })
    .catch(error => console.error('Error:', error));
