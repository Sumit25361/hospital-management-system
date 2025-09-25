
document.querySelectorAll('button').forEach((button) => {
    button.addEventListener('click', () => {
      alert(`${button.textContent} button clicked!`);
    });
  });
  