<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6 login-container">
      <h2 class="text-center mb-4">Inicia sesión</h2>

      <!-- mensaje  -->
      <?php if (isset($mensaje)): ?>
        <div class="alert alert-info"><?php echo $mensaje; ?></div>
      <?php endif; ?>

      <form method="POST" action="/login">
        <div class="text-center mt-3">
          <p>No tienes cuenta? <a href="/registro">Regístrate</a></p>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Correo Electrónico</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Contraseña</label>
          <input type="password" class="form-control" id="password" name="password" placeholder=" " required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Iniciar sesión</button>
      </form>
    </div>
  </div>
</div>
