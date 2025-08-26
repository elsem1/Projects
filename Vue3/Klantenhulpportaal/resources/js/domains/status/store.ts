
import { storeModuleFactory } from "../../services/store";
import { TicketStatus } from "./types";

export const statusStore = storeModuleFactory<TicketStatus>('ticket-statuses');