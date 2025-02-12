import {computed, ref} from 'vue';

// State
const inventory = [
    {id: 1, name: 'Biologisch katoen stof (meter)', actualAmount: 1200, minimumAmount: 500},
    {id: 2, name: 'Gerecycled polyester stof (meter)', actualAmount: 800, minimumAmount: 300},
    {id: 3, name: 'Biologisch jute stof (meter)', actualAmount: 150, minimumAmount: 50},
    {id: 4, name: 'Biologisch katoen garen (klos)', actualAmount: 200, minimumAmount: 100},
    {id: 5, name: 'Natuurlijke verfstoffen (liter)', actualAmount: 50, minimumAmount: 20},
    {id: 6, name: 'Biologisch linnen stof (meter)', actualAmount: 600, minimumAmount: 250},
    {id: 7, name: 'Gerecycled katoen stof (meter)', actualAmount: 700, minimumAmount: 300},
    {id: 8, name: 'Biologisch bamboe stof (meter)', actualAmount: 400, minimumAmount: 150},
    {id: 9, name: 'Eco-vriendelijke knopen (stuks)', actualAmount: 5000, minimumAmount: 2000},
    {id: 10, name: 'Biologisch hennep stof (meter)', actualAmount: 300, minimumAmount: 100},
];

// Getters
export const getAllProducts = computed(() => inventory.value);
export const getProductById = id => computed(() => products.value.find(product => product.id == id)).value;

// Actions
export const addProduct = product => products.value.push(product);
export const updateProduct = updatedProduct => {
    const i = products.value.findIndex(product => product.id === updatedProduct.id);
    if (i !== -1) {
        products.value.splice(i, 1, updatedProduct);
    }
};
export const deleteProduct = id => (inventory.value = inventory.value.filter(g => g.id != id));
