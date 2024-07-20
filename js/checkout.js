const paymentOption = document.querySelector(".paymentoption");
const closePopupBtn = document.querySelector(".closeBtn");
const CardpaymentSection = document.querySelector("#CardPaymentContainer");
const paymentUniversalBtn = document.querySelector("#paymentUniversalBtn");
const CardPaymentBtn = document.querySelector("#CardPaymentBtn");

const orderPlaceAdressform = document.getElementById("orderPlaceAdressform");
const UPIpaymentSection = document.querySelector("#UPIpaymentSection");
const closePopupBtnUPI = document.querySelector(".closeBtnUPI");
const UPIPaymentBtn = document.querySelector("#UPIPaymentBtn");

closePopupBtn.addEventListener("click", () => {
  CardpaymentSection.style.visibility = "hidden";
  paymentUniversalBtn.style.visibility = "visible";
  paymentOption.value = "";
});
closePopupBtnUPI.addEventListener("click", () => {
  UPIpaymentSection.style.visibility = "hidden";
  paymentUniversalBtn.style.visibility = "visible";
  paymentOption.value = "";
});

let paymentOptionValue = paymentOption.value;
paymentOption.addEventListener("change", (e) => {
  paymentOptionValue = paymentOption.value;

  if (paymentOption.value === "credit card") {
    CardpaymentSection.style.visibility = "visible";
    paymentUniversalBtn.style.visibility = "hidden";
  }

  if (paymentOption.value === "UPI payment") {
    UPIpaymentSection.style.visibility = "visible";
    paymentUniversalBtn.style.visibility = "hidden";
  }
});

CardPaymentBtn.addEventListener("click", (e) => {
  e.preventDefault();
  paymentUniversalBtn.click();
});
UPIPaymentBtn.addEventListener("click", (e) => {
  e.preventDefault();
  paymentUniversalBtn.click();
});

// ============================== Adress store ============================

document.addEventListener("DOMContentLoaded", function () {
  displayContacts();
});

function getContacts() {
  const contacts = localStorage.getItem("contacts");
  return contacts ? JSON.parse(contacts) : [];
}
function saveContact() {
  //const contactForm = document.getElementById('contactsList');
  //e.preventDefault()
  const Name = document.getElementById("Name").value;
  const Phone = document.getElementById("Phone").value;
  const Email = document.getElementById("Email").value;
  const AdressLine01 = document.getElementById("Addressline01").value;
  const AdressLine02 = document.getElementById("Addressline02").value;

  const PIN = document.getElementById("PIN").value;

  let contacts = getContacts();
  contacts.push({ Name, Phone, Email, AdressLine01, AdressLine02, PIN });

  localStorage.setItem("contacts", JSON.stringify(contacts));
  displayContacts();
}

function displayContacts() {
  const contacts = getContacts();
  const contactsList = document.getElementById("contactsList");
  contactsList.innerHTML = "";

  contacts.forEach((contact, index) => {
    const contactDiv = document.createElement("div");
    contactDiv.style.background = "rgb(89 164 165)";
    contactDiv.style.marginTop = "10px";
    contactDiv.style.padding = "2rem";
    contactDiv.style.fontSize = "2rem";
    
    contactDiv.className = "contact-item";
    contactDiv.innerHTML = `
            <p> ${contact.Name},${contact.Phone},${contact.Email},${contact.AdressLine01},${contact.AdressLine02},${contact.PIN}</p>
            
            <button onclick="fillForm(${index})" 
            style="padding: 1rem 1.3rem;
             margin: .4rem;
             border-radius: 10px;
             background: #102426;
             color: white;
             cursor: pointer;
             ">Apply</button>

            <button onclick="deleteContact(${index})"
            style="padding: 1rem 1.3rem;
             margin: .4rem;
             border-radius: 10px;
             background: #992b18;
             color: white;
             cursor: pointer;"
            >Delete</button>
        `;
    contactsList.appendChild(contactDiv);
  });
}
function fillForm(index) {
  const contacts = getContacts();
  document.getElementById("Name").value = contacts[index].Name;
  document.getElementById("Phone").value = contacts[index].Phone;
  document.getElementById("Email").value = contacts[index].Email;
  document.getElementById("Addressline01").value = contacts[index].AdressLine01;
  document.getElementById("Addressline02").value = contacts[index].AdressLine02;
  document.getElementById("PIN").value = contacts[index].PIN;
}

function deleteContact(index) {
  let contacts = getContacts();
  contacts.splice(index, 1);
  localStorage.setItem("contacts", JSON.stringify(contacts));
  displayContacts();
}





