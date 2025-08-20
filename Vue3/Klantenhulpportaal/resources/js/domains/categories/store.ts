import { CATEGORY_DOMAIN_NAME } from ".";
import { storeModuleFactory } from "../../services/store";
import { Category } from "./types";


export const categoryStore = storeModuleFactory<Category>(CATEGORY_DOMAIN_NAME);




