import { storeModuleFactory } from '../../js/services/store';
import { Review } from '../types';


// Initialiseert de store module voor reviews 
export const reviewStore = storeModuleFactory<Review>('reviews');
