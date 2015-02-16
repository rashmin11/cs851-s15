httpcode <- read.table(file.choose(), header=T, sep="\t")
> http <- c(httpcode$Redirects)
> hist(http, col="red", xlim=c(0,7))