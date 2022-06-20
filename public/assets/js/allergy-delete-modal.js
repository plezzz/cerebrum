let allergy =   document.querySelector("#allergyDelete").dataset;
let allergyID = allergy.allergyid;
let allergyName = allergy.allergy;

let textAllergy = `Сигурни ли сте, че искте да изтриете записа за алергия ${allergyName}`;
let pAllergy = document.querySelector("#allergy-deleteText");
let aAllergy = document.querySelector("#allergy-deleteLink");
pAllergy.textContent = textAllergy;
aAllergy.href = `/patient/remove/allergy/${allergyID}`;