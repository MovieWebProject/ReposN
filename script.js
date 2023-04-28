const nameEl = document.getElementById('name');
const emailEl = document.getElementById('email');
const changePasswordBtn = document.getElementById('change-password-btn');
const overlayEl = document.querySelector('.overlay');
const passwordChangeForm = document.querySelector('.password-change-form');
const closePasswordChangeBtn = document.getElementById('close-password-change-btn');
const oldPasswordInput = document.getElementById('old-password');
const newPasswordInput = document.getElementById('new-password');
const confirmNewPasswordInput = document.getElementById('confirm-new-password');

// TODO: Get user information from server
const user = {
  name: 'John Doe',
  email: 'johndoe@example.com'
};

nameEl.innerText = user.name;
emailEl.innerText = user.email;

changePasswordBtn.addEventListener('click', () => {
  overlayEl.classList.remove('hidden');
});

closePasswordChangeBtn.addEventListener('click', () => {
  overlayEl.classList.add('hidden');
});

passwordChangeForm.addEventListener('submit', (event) => {
  event.preventDefault();
  const oldPassword = oldPasswordInput.value;
  const newPassword = newPasswordInput.value;
  const confirmNewPassword = confirmNewPasswordInput.value;
  // TODO: Send password change request to server
  alert('Password changed successfully!');
  overlayEl.classList.add('hidden');
});