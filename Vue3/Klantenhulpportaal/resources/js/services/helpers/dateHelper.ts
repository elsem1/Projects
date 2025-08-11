
import dayjs from 'dayjs'
import relativeTime from 'dayjs/plugin/relativeTime'
import 'dayjs/locale/nl'

dayjs.extend(relativeTime)
dayjs.locale('nl')

export const formatRelativeTime = (date: string | Date) => {
    return dayjs(date).fromNow()
}

export const formatDate = (date: string | Date, format = 'DD-MM-YYYY HH:mm') => {
    return dayjs(date).format(format)
}