
import { storeModuleFactory } from "../../services/store";
import { TicketStatus } from "./types";

export const StatusStore = storeModuleFactory<TicketStatus>('ticket-statuses');