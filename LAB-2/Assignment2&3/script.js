function generateFields() {
    const number_of_people = document.getElementById("number_of_people").value;
    const form_of_people = document.getElementById("form_of_people");
    form_of_people.innerHTML = "";

    for (let i = 1; i <= number_of_people; i++) {
        form_of_people.innerHTML += `
                    <fieldset>
                        <legend>Details of the person ${i}:</legend>
                        <label for="first_name_${i}">First Name:</label>
                        <input type="text" id="first_name_${i}" name="first_name_${i}" pattern="[A-Za-z]+" required><br><br>
                        <label for="last_name_${i}">Last Name:</label>
                        <input type="text" id="last_name_${i}" name="last_name_${i}" pattern="[A-Za-z]+" required><br><br>
                    </fieldset>
                    <br>
                `;
    }
}