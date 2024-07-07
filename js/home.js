// Edit Btn
document.querySelectorAll(".edit-contact").forEach(button => {
  button.onclick = function() {
    var name = this.getAttribute("data-name");
    var city = this.getAttribute("data-city");
    var phone = this.getAttribute("data-phone");
    var email = this.getAttribute("data-email");
    document.getElementById("edit-name").value = name;
    document.getElementById("edit-city").value = city;
    document.getElementById("edit-phone").value = phone;
    document.getElementById("edit-email").value = email;
    document.getElementById("oldName").value = name;
    document.getElementById("oldCity").value = city;
    document.getElementById("oldPhone").value = phone;
    document.getElementById("oldEmail").value = email;
  };
});
// Delete Btn
document.querySelectorAll(".del-contact").forEach(button => {
  button.onclick = function() {
    var name = this.getAttribute("data-name");
    var city = this.getAttribute("data-city");
    var phone = this.getAttribute("data-phone");
    var email = this.getAttribute("data-email");
    document.getElementById("dlt-name").value = name;
    document.getElementById("dlt-city").value = city;
    document.getElementById("dlt-phone").value = phone;
    document.getElementById("dlt-email").value = email;
  };
});
// Searching
let searchField = document.querySelector('.search_field');
let tableRows = document.querySelectorAll('table tbody tr');
searchField.addEventListener('keyup', function() {
  let searchTerm = searchField.value.toLowerCase().trim();
  tableRows.forEach(function(row) {
    let textContent = row.textContent.toLowerCase();
    console.log(textContent);
    if (textContent.includes(searchTerm)) {
      row.style.display = '';
    } else {
      row.style.display = 'none';
    }
  });
});