import { storeModuleFactory } from '../../js/services/store';
import { Author } from '../types';


// Initialiseert de store module voor boeken met genres 
export const authorStore = storeModuleFactory<Author>('authors');

// Haalt de lijst van boeken op bij het laden van component
authorStore.actions.getAll();


