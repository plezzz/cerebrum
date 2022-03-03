let contact =   document.querySelector("#contactDelete").dataset;
let id = contact.contactid;
let firstName = contact.firstname;
let lastName = contact.lastname;

let text = `Сигурни ли сте, че искте да изтриете контакта ${firstName} ${lastName}`;
let p = document.querySelector("#contact-deleteText");
let a = document.querySelector("#contact-deleteLink");
p.textContent = text;
a.href = `/patient/contact-delete/${id}`;