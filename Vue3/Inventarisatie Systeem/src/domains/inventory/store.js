import {computed, ref} from 'vue';

// State
const products = ref([
    {id: 1, name: 'Biologisch katoen stof (meter)', actualAmount: 0, minimumAmount: 500},
    {id: 2, name: 'Gerecycled polyester stof (meter)', actualAmount: 800, minimumAmount: 300},
    {id: 3, name: 'Biologisch jute stof (meter)', actualAmount: 150, minimumAmount: 50},
    {id: 4, name: 'Biologisch katoen garen (klos)', actualAmount: 200, minimumAmount: 100},
    {id: 5, name: 'Natuurlijke verfstoffen (liter)', actualAmount: 50, minimumAmount: 20},
    {id: 6, name: 'Biologisch linnen stof (meter)', actualAmount: 600, minimumAmount: 250},
    {id: 7, name: 'Gerecycled katoen stof (meter)', actualAmount: 200, minimumAmount: 300},
    {id: 8, name: 'Biologisch bamboe stof (meter)', actualAmount: 400, minimumAmount: 150},
    {id: 9, name: 'Eco-vriendelijke knopen (stuks)', actualAmount: 85, minimumAmount: 2000},
    {id: 10, name: 'Biologisch hennep stof (meter)', actualAmount: 300, minimumAmount: 100},
]);

// Getters
export const getAllProducts = () => products.value;
export const getProductById = (id) => computed(() => products.value.find(product => product.id == id));

// Actions
export const addProduct = product => products.value.push(product);
export const modifyProduct = (id, updatedProduct = null) => {
  const index = products.value.findIndex(product => product.id === id);
  if (index !== -1) {
    if (updatedProduct) {
      // Update het product
      products.value.splice(index, 1, updatedProduct);
    } else {
      // Verwijder het product
      products.value.splice(index, 1);
    }
  }
};
// export const deleteProduct = (id) => {
//   products.value = products.value.filter(product => product.id !== id);
// };

// export const deleteProduct = (id) => {
//   const index = products.value.findIndex(product => product.id === id);
//   if (index !== -1) {
//     products.value.splice(index, 1);
//   }
// };

