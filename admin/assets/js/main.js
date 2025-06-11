document.addEventListener("DOMContentLoaded", function () {
  const links = document.querySelectorAll(".menu-item");
  const content = document.getElementById("content");

  function setActive(link) {
    links.forEach(l => l.classList.remove("active-link"));
    link.classList.add("active-link");
  }

  function loadPage(page, clickedLink = null) {
    content.innerHTML = `
      <div class="flex items-center space-x-2">
        <svg class="animate-spin h-5 w-5 text-gray-500" viewBox="0 0 24 24">
          <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
          <path class="opacity-75" fill="currentColor"
                d="M4 12a8 8 0 018-8v4l3.5-3.5L12 0v4a8 8 0 00-8 8z"></path>
        </svg>
        <span>Loading...</span>
      </div>
    `;

    fetch(`pages/${page}.php`)
      .then(res => {
        if (!res.ok) throw new Error("Page not found");
        return res.text();
      })
      .then(data => {
        content.innerHTML = data;
        if (clickedLink) setActive(clickedLink);
      })
      .catch(err => {
        content.innerHTML = `<p class="text-red-500">Error loading page: ${err.message}</p>`;
      });
  }

  links.forEach(link => {
    link.addEventListener("click", function (e) {
      e.preventDefault();
      const page = this.getAttribute("data-page");
      loadPage(page, this);
    });
  });

  // Load default
  loadPage('dashboard', links[0]);
});
