<?php
 require 'partials/header.php'; 
 require 'partials/nav.php'; 
 require 'partials/banner.php' ?>


<main>
<form action="" method="POST" class="space-y-6">
  <table class="min-6/10 divide-y mt-12 divide-gray-200">
    <thead class="bg-gray-50">
      <tr>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hoeveelheid</th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prijs per stuk</th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subtotaal</th>
      </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
      <?php foreach ($items as $item): ?>
        <tr>
          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo htmlspecialchars($item['name']); ?></td>
          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo htmlspecialchars($item['number']); ?></td>
          <td id="productPrice" class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">€&nbsp;<?php echo showComma($item['price']); ?></td>
          <td id="productPrice" class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">€&nbsp;<?php echo showComma(calcSubTotal($item['price'], $item['number'])); ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <div class="mt-4 text-right">
    <span class="text-lg font-medium text-gray-900">Totaal: €<?php echo showComma(($total)); ?></span>
  </div>
</form>


     


  <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
    
  </div>
</main>
<?php require 'partials/footer.php' ?>

