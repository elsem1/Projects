import { USER_DOMAIN_NAME } from ".";
import { storeModuleFactory } from "../../services/store";
import { User } from "./types";

export const userStore = storeModuleFactory<User>(USER_DOMAIN_NAME)
