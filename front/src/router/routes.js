import BookList from "@/components/BookList"
import AuthorList from "@/components/AuthorList"
const routes = [
    {
        path: '/',
        component: BookList
    },
    {
        path: '/authors',
        component: AuthorList
    },
    {
        path: '/books/:genreId',
        name: 'BookListByGenre',
        component: BookList,
    },
]
export default routes