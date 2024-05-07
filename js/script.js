const body = document.querySelector("body"),
  sidebar = document.querySelector(".sidebar"),
  modeSwitch = document.querySelector(".toggle-switch"),
  modeText = document.querySelector(".mode-text"),
  searchBtn = document.querySelector(".search-bar");

modeSwitch.addEventListener("click", () => {
  body.classList.toggle("dark");
  //   document.querySelector(".mode-text").innertext=""

  if (body.classList.contains("dark")) {
    modeText.innerText = " Light Mode ";
  } else modeText.innerText = " Dark Mode ";
});
