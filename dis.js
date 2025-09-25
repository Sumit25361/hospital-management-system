
window.onload = function() {
    fetch('fetch_patients.php') 
        .then(response => response.json())
        .then(data => {
            const selectElement = document.getElementById('customerId');
            data.forEach(patient => {
                const option = document.createElement('option');
                option.value = patient.id; 
                option.textContent = `Patient ${patient.id} - ${patient.name}`;
                selectElement.appendChild(option);
            });
        })
        .catch(error => console.error('Error fetching patient IDs:', error));
};
function fetchPatientDetails() {
    const customerId = document.getElementById('customerId').value;
    if (customerId) {
        fetch(`get_patient_details.php?id=${customerId}`)
            .then(response => response.json())
            .then(data => {
                if (data) {
                    document.getElementById('roomNumber').value = data.room;
                    document.getElementById('inTime').value = data.in_time;
                    document.getElementById('outTime').value = data.out_time;
                } else {
                    alert("No details found for this patient.");
                }
            })
            .catch(error => console.error('Error fetching patient details:', error));
    }
}
