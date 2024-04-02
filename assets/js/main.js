document.addEventListener('DOMContentLoaded', function() {
    const toggleButtons = document.querySelectorAll('.toggle-password');

    toggleButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            const passwordField = this.parentElement.querySelector('input[type="password"]');
            const fieldType = passwordField.getAttribute('type');
            
            // Verifica se a senha está visível ou não
            const isPasswordVisible = fieldType === 'text';
            
            // Alterna a visibilidade da senha
            passwordField.setAttribute('type', isPasswordVisible ? 'password' : 'text');
            
            // Atualiza o ícone do botão
            this.querySelector('i').classList.toggle('fa-eye', !isPasswordVisible);
            this.querySelector('i').classList.toggle('fa-eye-slash', isPasswordVisible);
        });
    });
});
