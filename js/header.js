let profileName = document.querySelector(".profile p");

const UserBtn = document.querySelector("#user-btn");

if (profileName.textContent !== "") {
  UserBtn.innerHTML = `<h6 style="font-size:10px ; color:green">${profileName.textContent}</h6>`;
}

