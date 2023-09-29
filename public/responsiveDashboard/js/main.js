// add hovered class to selected list item
// let list = document.querySelectorAll(".navigationn li");

// function activeLink() {
//     list.forEach((item) => {
//         item.classList.remove("hovered");
//     });
//     this.classList.add("hovered");
// }

// list.forEach((item) => item.addEventListener("mouseover", activeLink));

// Menu Toggle
let toggle = document.querySelector(".toggle");
let navigationn = document.querySelector(".navigationn");
let main = document.querySelector(".main");

toggle.onclick = function () {
    navigationn.classList.toggle("active");
    main.classList.toggle("active");
};
// Add this code to ensure the side menu is not active by default
navigationn.classList.remove("active");
main.classList.remove("active");

// Function to check window size and open side menu if needed
function checkWindowSize() {
    if (window.innerWidth >= 768) {
        // You can adjust the threshold as needed
        navigationn.classList.add("active");
        main.classList.add("active");
    } else {
        navigationn.classList.remove("active");
        main.classList.remove("active");
    }
}

// Initial check on page load
checkWindowSize();

// Listen for window resize events
window.addEventListener("resize", checkWindowSize);
