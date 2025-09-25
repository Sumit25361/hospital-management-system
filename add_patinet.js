document.getElementById('addPatientForm').addEventListener('submit', function (event) {
    event.preventDefault(); 

    const name = document.getElementById('name').value.trim();
    const disease = document.getElementById('disease').value.trim();
    const room = document.getElementById('room').value;
    const deposit = document.getElementById('deposit').value;
    const time = document.getElementById('time').value;

    if (!name || !disease || !room || !deposit || !time) {
        alert('Please fill in all fields.');
        return;
    }

    
    const formData = new FormData(this);

   
    fetch('backend/add_patient.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById('successMessage').style.display = 'block';
            document.getElementById('addPatientForm').reset();
        } else {
            alert('Error: ' + data.error);
        }
    })
    .catch(error => console.log('Error:', error));
});
