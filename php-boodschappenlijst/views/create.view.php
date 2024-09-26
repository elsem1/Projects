
<?php require 'partials/header.php'; ?>
<?php require 'partials/nav.php'; ?>
<?php require 'partials/banner.php'; ?>

<main>
  <form action="" method="POST" class="space-y-6 mt-12">
    <div>
      <label for="product" class="block text-sm font-medium text-gray-900">Welk product wil je toevoegen?</label>
      <input type="text" name="name" placeholder="Aardappelen" class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>" required>
      <?php if (isset($errors['name'])) : ?>
        <div class="flex justify-center">
          <p class="text-red-500 text-xs mt-2"><?= $errors['name'] ?></p>
        </div>
      <?php endif; ?>
    </div>

    <div>
      <label for="quantity" class="block text-sm font-medium text-gray-900">Hoeveel stuks wil je?</label>
      <input type="number" name="number" class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="<?= htmlspecialchars($_POST['number'] ?? '') ?>" required>
      <?php if (isset($errors['number'])) : ?>
        <div class="flex justify-center">
          <p class="text-red-500 text-xs mt-2"><?= $errors['number'] ?></p>
        </div>
      <?php endif; ?>
    </div>

    <div>
      <label for="price" class="block text-sm font-medium text-gray-900">Wat kost het product per stuk?</label>
      <div class="mt-2 flex rounded-md shadow-sm">
        <span class="inline-flex items-center rounded-l-md border border-r-0 border-gray-300 bg-gray-50 px-3 text-gray-500 sm:text-sm">€</span>
        <input type="text" name="price" class="block w-full flex-1 rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="<?= htmlspecialchars($_POST['price'] ?? '') ?>" required>
      </div>
      <?php if (isset($errors['price'])) : ?>        
        <p class="text-red-500 text-xs mt-2 ml-10"><?= $errors['price'] ?></p> 
      <?php endif; ?>
    </div>

    <div class="flex items-center justify-end">
      <button type="submit" name="post" value="post" class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Voeg toe</button>
    </div>
  </form>
</main>

<?php require 'partials/footer.php'; ?>

    