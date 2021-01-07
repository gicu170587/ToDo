export function isNameJoe(value) {
    if (!value) return true;
    return value === "Joe";
  }
  
  export function notGmail(value = "") {
    return !value.includes("gmail");
  }
  
  export function validateEmail(value) {
    if (value === "") return true;
  
    return new Promise((resolve, reject) => {
      setTimeout(() => {
        resolve(value.length > 10);
      }, 500);
    });
  }
  