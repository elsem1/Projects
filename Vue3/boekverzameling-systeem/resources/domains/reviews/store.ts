import { storeModuleFactory } from '../../js/services/store';
import { Review } from '../types';
import { computed } from 'vue';


// Initialiseert de store module voor reviews 
const baseReviewStore = storeModuleFactory<Review>('reviews');

export const reviewStore = {
    actions: {
        ...baseReviewStore.actions,
    },
        getters: {
            ...baseReviewStore.getters,
            byBookId: (value: number) => computed(() => baseReviewStore.getters.all.value.filter(item => item.book_id === value)),
        },
    };