import 'dart:convert';
import 'package:bookapp/app/Constants/images.dart';
import 'package:bookapp/app/Features/Views/Dashboard/authors/authorsScreen.dart';
import 'package:carousel_slider/carousel_slider.dart';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'package:bookapp/app/Features/Views/Dashboard/Categorys/CategoryBooksPage.dart';
import 'package:bookapp/app/Features/Models/model_books.dart';
import 'package:bookapp/app/Features/Views/widgets/FooterWidget.dart';
import 'package:bookapp/app/Features/Views/widgets/HeaderWidget.dart';
import 'package:bookapp/app/Features/Views/widgets/SearchBoxWidget.dart';
import 'package:bookapp/app/Features/Views/widgets/BookSectionWidget.dart';

class HomeScreen extends StatefulWidget {
  @override
  _HomeScreenState createState() => _HomeScreenState();
}

class _HomeScreenState extends State<HomeScreen> {
  List<Book> newArrivalBooks = [];
  List<Book> forYouBooks = [];
  List<Map<String, dynamic>> authors = [];
  bool isLoadingAuthors = true;
  bool isLoading = true;
  List<Map<String, dynamic>> categories = [];

  @override
  void initState() {
    super.initState();
    _fetchBooks();
    _loadCategories();
    _fetchAuthors();
  }

  Future<void> _fetchAuthors() async {
    try {
      final response = await http
          .get(Uri.parse('http://192.168.100.19:80/bookstore/showAuthors.php'));

      print('API Response: ${response.body}'); 

      if (response.statusCode == 200) {
        final decodedResponse = json.decode(response.body);
        print('Decoded Response: $decodedResponse');

        setState(() {

          authors =
              List<Map<String, dynamic>>.from(decodedResponse).map((author) {
            author['ath_image'] =
                'http://192.168.100.19:80/bookstore/' + author['ath_image'];
            return author;
          }).toList();

          isLoading = false;
        });
      } else {
        setState(() {
          authors = [];
          isLoading = false;
        });
      }
    } catch (e) {
      print("Error loading authors: $e");
      setState(() {
        authors = [];
        isLoading = false;
      });
    }
  }

  Future<void> _fetchBooks() async {
    try {
      final response = await http
          .get(Uri.parse('http://192.168.100.19:80/bookstore/showBooks.php'));
      if (response.statusCode == 200) {
        final booksData = json.decode(response.body) as List;
        setState(() {
          final books = booksData.map((book) => Book.fromJson(book)).toList();
          newArrivalBooks = books.take(10).toList();
          forYouBooks = books.where((book) {
            double? parsedRating = double.tryParse(book.rating);
            return parsedRating != null && parsedRating >= 4.0;
          }).toList();

          isLoading = false;
          print('Books data: $booksData');
          isLoading = false;
          print('Books data: $booksData');
        });
      } else {
        setState(() {
          isLoading = false;
        });
      }
    } catch (e) {
      print("Error fetching books: $e");
      setState(() {
        isLoading = false;
      });
    }
  }


  Future<void> _loadCategories() async {
    try {
      final response = await http.get(
          Uri.parse('http://192.168.100.19:80/bookstore/showCategories.php'));
      print(
          'API Response: ${response.body}'); 

      if (response.statusCode == 200) {
        var decodedResponse = json.decode(response.body);
        print(
            'Decoded Response: $decodedResponse'); 

        setState(() {
          categories = List<Map<String, dynamic>>.from(decodedResponse);
          isLoading = false;
        });
      } else {
        setState(() {
          categories = [];
          isLoading = false;
        });
      }
    } catch (e) {
      print("Error loading categories: $e");
      setState(() {
        categories = [];
        isLoading = false;
      });
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: PreferredSize(
        preferredSize: Size.fromHeight(kToolbarHeight),
        child: HeaderWidget(),
      ),
      body: isLoading
          ? Center(child: CircularProgressIndicator())
          : SafeArea(
              child: SingleChildScrollView(
                child: Padding(
                  padding:
                      EdgeInsets.symmetric(vertical: 20.0, horizontal: 23.0),
                  child: Column(
                    children: [
                      SearchBoxWidget(),
                      const SizedBox(height: 25.0),

               
                      SingleChildScrollView(
                        scrollDirection: Axis.horizontal,
                        child: Row(
                          children: categories.isEmpty
                              ? [Text('No Categories Found')]
                              : categories.map((category) {
                                  return _makeCategoryEl(category['cname'],
                                      context, int.parse(category['cid']));
                                }).toList(),
                        ),
                      ),

                      const SizedBox(height: 50.0),

                
                      BookSectionWidget(
                        title: "New Arrival",
                        bookList: newArrivalBooks,
                        context: context,
                      ),

             
                      BookSectionWidget(
                        title: "For You",
                        bookList: forYouBooks,
                        context: context,
                      ),
                      SingleChildScrollView(
                        child: Padding(
                          padding: const EdgeInsets.symmetric(vertical: 10.0),
                          child: Column(
                            crossAxisAlignment: CrossAxisAlignment
                                .start, 
                            children: [
                        
                              Padding(
                                padding: const EdgeInsets.only(left: 0),
                                child: Text(
                                  'Books By Authors',
                                  style: TextStyle(
                                    fontSize: 18.0,
                                    fontWeight: FontWeight.bold,
                                  ),
                                ),
                              ),
                              const SizedBox(height: 10),

                            
                              SingleChildScrollView(
                                scrollDirection: Axis.horizontal,
                                child: Padding(
                                  padding: const EdgeInsets.symmetric(
                                      vertical: 10.0),
                                  child: Row(
                                    children: authors.isEmpty
                                        ? [Text('No Authors Found')]
                                        : authors.map((author) {
                                            return Padding(
                                              padding: const EdgeInsets.only(
                                                  right:
                                                      20.0), 
                                              child: GestureDetector(
                                                onTap: () {
                                                  Navigator.push(
                                                    context,
                                                    MaterialPageRoute(
                                                      builder: (context) =>
                                                          AuthorBooksPage(
                                                        authorId: int.parse(
                                                            author[
                                                                'author_id']),
                                                        authorName:
                                                            author['ath_name'],
                                                      ),
                                                    ),
                                                  );
                                                },
                                                child: Column(
                                                  children: [
                                                    CircleAvatar(
                                                      backgroundImage:
                                                          NetworkImage(author[
                                                              'ath_image']),
                                                      radius: 30,
                                                    ),
                                                    SizedBox(height: 5),
                                                    Text(
                                                      author['ath_name'],
                                                      style: TextStyle(
                                                          fontSize: 12),
                                                    ),
                                                  ],
                                                ),
                                              ),
                                            );
                                          }).toList(),
                                  ),
                                ),
                              ),
                            ],
                          ),
                        ),
                      ),

                      const SizedBox(height: 7.0),

                 
                      Container(
                        width: double.infinity,
                        height: 180.0,
                        decoration: BoxDecoration(
                          borderRadius: BorderRadius.all(Radius.circular(15.0)),
                          gradient: LinearGradient(
                            begin: FractionalOffset.topLeft,
                            end: FractionalOffset.bottomRight,
                            colors: const [
                              Color(0xffe4a972),
                              Color(0xff9941d8),
                            ],
                          ),
                        ),
                        child: Column(
                          children: [
                         
                            CarouselSlider(
                              options: CarouselOptions(
                                autoPlay: true,
                                autoPlayInterval: Duration(
                                    seconds: 3), 
                                autoPlayAnimationDuration: Duration(
                                    milliseconds: 800), 
                                enlargeCenterPage:
                                    true, 
                                aspectRatio:
                                    2.0, 
                                viewportFraction:
                                    0.8, 
                              ),
                              items: [
                                
                                Image.asset(
                                  CarouselImage2,
                                  fit: BoxFit.cover,
                                  width: double.infinity,
                                ),
                                Image.asset(
                                  CarouselImage1,
                                  fit: BoxFit.cover,
                                  width: double.infinity,
                                ),
                              ],
                            ),
                          ],
                        ),
                      )
                    ],
                  ),
                ),
              ),
            ),
      bottomNavigationBar: FooterWidget(),
    );
  }


  Widget _makeCategoryEl(String title, BuildContext context, int categoryId) {
    return GestureDetector(
      onTap: () {
        Navigator.push(
          context,
          MaterialPageRoute(
            builder: (context) =>
                CategoryBooksPage(categoryId: categoryId, categoryName: title),
          ),
        );
      },
      child: Container(
        height: 40.0,
        padding: const EdgeInsets.symmetric(horizontal: 20.0, vertical: 5.0),
        margin:
            const EdgeInsets.only(right: 10.0),
        decoration: BoxDecoration(
          borderRadius: const BorderRadius.all(Radius.circular(20.0)),
          color: const Color(0xFFF0F2F5),
        ),
        child: Center(
          child: Text(
            title,
            style: const TextStyle(
              fontSize: 14.0,
              fontWeight: FontWeight.w400,
              color: Colors.black,
            ),
          ),
        ),
      ),
    );
  }
}
