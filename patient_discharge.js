function navigate(page) {
    alert(`Navigate to ${page} page`);
}

function checkPatient() {
    const customerId = document.getElementById("customerId").value;
    if (customerId) {
        fetch(`fetchPatientData.php?customerId=${customerId}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById("roomNumber").value = data.roomNumber;
                document.getElementById("inTime").value = data.inTime;
            })
            .catch(err => console.error(err));
    } else {
        alert("Please select a Customer ID!");
    }
}

function goBack() {
    history.back();
}
