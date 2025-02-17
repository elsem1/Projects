import {computed, ref} from 'vue';

// State
const products = ref([
  {id: 1, name: 'Lithium-ion batterij', actualAmount: 0, minimumAmount: 500},
  {id: 2, name: 'Gerecyclede printplaten', actualAmount: 1200, minimumAmount: 800},
  {id: 3, name: 'SMD weerstanden', actualAmount: 5000, minimumAmount: 2000},
  {id: 4, name: 'Kabels voor elektronica (m)', actualAmount: 1500, minimumAmount: 1000},
  {id: 5, name: 'Microchips', actualAmount: 1, minimumAmount: 5000},
  {id: 6, name: 'LCD schermen', actualAmount: 200, minimumAmount: 50},
  {id: 7, name: 'USB-kabels', actualAmount: 157, minimumAmount: 600},
  {id: 8, name: 'LED-lampjes', actualAmount: 67, minimumAmount: 2000},
  {id: 9, name: 'Electromotoren', actualAmount: 150, minimumAmount: 100},
  {id: 10, name: 'Soldeerbouten', actualAmount: 50, minimumAmount: 30},
]);


// Getters
export const getAllProducts = computed(() => products.value);
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

