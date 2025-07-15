import { storeModuleFactory } from "../../services/store";
import type { Category } from "../tickets/types";

export const CategoryStore = storeModuleFactory<Category>("categories");